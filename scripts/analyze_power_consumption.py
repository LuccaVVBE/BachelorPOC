import pandas as pd
import matplotlib.pyplot as plt
import seaborn as sns

# Load the data
df_monolith = pd.read_csv('monolith_power_consumption.csv')
df_microservices = pd.read_csv('microservices_power_consumption.csv')

# Add a column to identify the type of application
df_monolith['Application Type'] = 'Monolith'
df_microservices['Application Type'] = 'Microservices'

# Combine the dataframes
df = pd.concat([df_monolith, df_microservices], ignore_index=True)

# Convert 'Tijd' to a numeric type, if not already
df['Tijd'] = pd.to_numeric(df['Tijd'], errors='coerce')

# Convert Energie columns to numeric types, if not already
df['CPU Energie'] = pd.to_numeric(df['CPU Energie'], errors='coerce')
df['GPU Energie'] = pd.to_numeric(df['GPU Energie'], errors='coerce')
df['Total Energie'] = pd.to_numeric(df['Total Energie'], errors='coerce')

# Calculate averages
df_avg = df.groupby(['Scenario', 'Application Type']).mean().reset_index()

# Plotting
sns.set(style="whitegrid")

# Plot 1: Average Total Energie Consumption Comparison
plt.figure(figsize=(12, 6))
sns.barplot(x='Scenario', y='Total Energie', hue='Application Type', data=df_avg)
plt.title('Average Total Energie Consumption Comparison')
plt.xlabel('Scenario')
plt.ylabel('Total Energie')
plt.legend(title='Application Type')
plt.savefig('avg_total_energie_comparison.png')
plt.show()

# Plot 2: Average CPU and GPU Energie Consumption Comparison
plt.figure(figsize=(12, 6))
df_avg_melted = df_avg.melt(id_vars=['Scenario', 'Application Type'], 
                            value_vars=['CPU Energie', 'GPU Energie'], 
                            var_name='Energie Type', value_name='Energie')
sns.barplot(x='Scenario', y='Energie', hue='Application Type', data=df_avg_melted, errorbar=None)
plt.title('Average CPU and GPU Energie Consumption Comparison')
plt.xlabel('Scenario')
plt.ylabel('Energie')
plt.legend(title='Application Type')
plt.savefig('avg_cpu_gpu_energie_comparison.png')
plt.show()

# Plot 3: Average Tijd Comparison
plt.figure(figsize=(12, 6))
sns.barplot(x='Scenario', y='Tijd', hue='Application Type', data=df_avg)
plt.title('Average Tijd Comparison')
plt.xlabel('Scenario')
plt.ylabel('Tijd')
plt.legend(title='Application Type')
plt.savefig('avg_total_time_comparison.png')
plt.show()

# Plot 4: Distribution of Total Energie Consumption
plt.figure(figsize=(12, 6))
sns.boxplot(x='Scenario', y='Total Energie', hue='Application Type', data=df)
plt.title('Distribution of Total Energie Consumption')
plt.xlabel('Scenario')
plt.ylabel('Total Energie')
plt.legend(title='Application Type')
plt.savefig('energie_distribution_comparison.png')
plt.show()

